<?php

namespace RELSIAFI\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Process\Process;

use \Config as Config;

class Credencial extends Model
{
    protected $table  = 'RELSIAFI.credencial';
    protected $primaryKey = 'id_credencial';
    protected $hidden = ['nr_cpf', 'ds_senha'];

    public $timestamps = false;

    public function scopeAtivo($query) {
        return $query->where('st_ativo', 'A');
    }

    public function scopeInativo($query) {
        return $query->where('st_ativo', 'I');
    }

    public function scopeDeletado($query) {
        return $query->where('st_deletado', 'S');
    }

    public function scopeNaoDeletado($query) {
        return $query->where('st_deletado', 'N');
    }

    public function arquivos_recebidos() {
        return $this->belongsToMany('RELSIAFI\Models\ArquivoRecebido', 'id_credencial', 'id_credencial');
    }

    public function auditorias() {
        return $this->belongsToMany('RELSIAFI\Models\Auditoria', 'id_credencial', 'id_credencial');
    }

    public static function encryptData($data) {
        $script = "echo '" . $data . "' | openssl rsautl -encrypt -pubin -inkey " . Config::get('keys.path.public');

        $process = new Process($script);
        $process->setTimeout(7200);
        $process->run();

        if ($process->isSuccessful()) {
            return base64_encode($process->getOutput());
        }

        return false;
    }

    public static function decryptData($data) {
        $script = "echo '" . $data . "' | base64 --decode | openssl rsautl -decrypt -inkey " . Config::get('keys.path.private');

        $process = new Process($script);
        $process->setTimeout(7200);
        $process->run();

        if ($process->isSuccessful()) {
            return $process->getOutput();
        }

        return false;
    }

    public static function checkSTA($CPF, $password) {
        $script = base_path() . '/resources/bash/crawler.sh ' . $CPF . ' ' .$password . ' true';

        $process = new Process($script);
        $process->setTimeout(7200);
        $process->run();

        if ($process->isSuccessful() && trim($process->getOutput()) == 'OK') {
            return true;
        }

        return false;
    }

    public static function checkCPF($CPF) {
        $credenciais = Credencial::naodeletado()->get();

        foreach ($credenciais as $credencial) {
            $cpf_banco = trim(Credencial::decryptData($credencial->nr_cpf));

            if($cpf_banco === $CPF) {
                return true;
            }
        }

        return false;
    }
}
