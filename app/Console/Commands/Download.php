<?php

namespace RELSIAFI\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

use RELSIAFI\Models\Credencial;

class Download extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'relsiafi:download';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Efetua download dos arquivos disponíveis no STA';

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
        $credencial = Credencial::where('st_ativo', 'A')->firstOrFail();

        if($credencial) {
            $script = base_path() . '/resources/bash/crawler.sh ' . $credencial->nr_cpf . ' ' .$credencial->ds_senha;

            $process = new Process($script);
            $process->setTimeout(7200);
            $process->run();

            if ($process->isSuccessful()) {
                echo $process->getOutput();
            }
        } else {
            $this->comment(PHP_EOL .'Nenhuma credencial foi encontrada' . PHP_EOL);
        }
    }
}
