<?php

namespace RELSIAFI\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Carbon\Carbon;

use RELSIAFI\Models\Auditoria as Auditoria;
use RELSIAFI\Models\ArquivoRecebido as ArquivoRecebido;
use RELSIAFI\Models\TipoArquivo as TipoArquivo;
use RELSIAFI\Models\Credencial as Credencial;

class ContaLinhas extends Command
{

    const SUCESSO = 1;
    const SEM_SUCESSO = 2;
    const ARQUIVO_VAZIO = 3;

    private $linhas = [];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'relsiafi:conta_linhas {localizacao}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Conta as linhas dos arquivos disponíveis';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->populateLines((integer) $this->argument('localizacao'));
        $tipos_de_arquivo = TipoArquivo::naoCapturado($this->argument('localizacao'));

        try {
            foreach ($tipos_de_arquivo as $tipo_arquivo) {

                $auditoria = new Auditoria;
                $auditoria->id_credencial = Credencial::ativo()->first()->id_credencial;
                $auditoria->id_tipo_arquivo = $tipo_arquivo->id_tipo_arquivo;
                $auditoria->id_execucao_status = self::SEM_SUCESSO;

                foreach ($this->linhas as $line) {
                    if(preg_match('@(?<arquivo>' . $tipo_arquivo->ds_expressao_regular . '.*?[[:blank:]])(?<linhas>\d+)@is', $line, $match)) {

                        $quantidadeDeLinhas = (integer) $match['linhas'];
                        $arquivoJaCapturado = ArquivoRecebido::where('nm_arquivo', $match['arquivo'])->count();
                        $ehDoDiaAnterior = $this->formatData($match['data'])->format('Y-m-d') == Carbon::yesterday()->format('Y-m-d');

                        if( ! $arquivoJaCapturado && $ehDoDiaAnterior) {
                            if($quantidadeDeLinhas > 0) {

                                $arquivo_recebido = new ArquivoRecebido;
                                $arquivo_recebido->id_tipo_arquivo = $tipo_arquivo->id_tipo_arquivo;
                                $arquivo_recebido->nm_arquivo = trim($match['arquivo']);
                                $arquivo_recebido->qtd_linhas = $match['linhas'];
                                $arquivo_recebido->dt_recebimento = $this->formatData($match['data']);

                                if($arquivo_recebido->save()) {
                                    $auditoria->id_arquivo_recebido = $arquivo_recebido->id_arquivo_recebido;
                                    $auditoria->id_execucao_status = self::SUCESSO;
                                }

                            } else {
                                $auditoria->id_execucao_status = self::ARQUIVO_VAZIO;
                            }
                        }
                    }
                }

                $auditoria->save();
            }

            echo PHP_EOL;
        } catch(Exception $exception) {
            echo $exception;
        }
    }

    private function formatData($data) {

        // PEGAR O ANO PASSADO
        if(strlen($data) === 5) {
            $data = preg_replace('#(\d{2})(\d{2})#is', '\1/\2/', substr($data, 1)) . Carbon::yesterday()->format('y');
            return Carbon::createFromFormat('d/m/y', $data);
        } elseif(strlen($data) === 7) {
            $data = preg_replace('#(\d{2})(\d{2})(\d{2})#is', '\1/\2/\3', substr($data, 1));
            return Carbon::createFromFormat('d/m/y', $data);
        } else {
            $data = preg_replace('#(\d{4})(\d{2})(\d{2})#is', '\1-\2-\3', $data);
            return Carbon::createFromFormat('Y-m-d', $data);
        }

        return false;
    }

    private function getLocation($location) {
        $stringLocation = '/opt/pobox/';

        switch ($location) {
            case 1:
            return $stringLocation . 'recebidos/';
            case 2:
            return $stringLocation . 'sta/';
        }
    }

    public function populateLines($location) {
        $process = new Process("ssh -q siafi@misrv35 '/home/siafi/contador_linhas.sh " . $this->getLocation($location) . "'");
        $process->setTimeout(7200);
        $process->run(function($type, $buffer) {
            $this->linhas[] = trim($buffer);
        });
    }
}
