<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdutoSeeder extends Seeder
{
    public function run(): void
    {
        $produtos = [

            /* =========================
               CORDAS
            ========================= */

            [
                'nome' => 'Fender Guitarra Stratocaster Player II',
                'descricao' => 'Guitarra elétrica versátil, indicada para estudos, gravações e apresentações.',
                'preco' => 8999.00,
                'quantidade' => 8,
                'categoria' => 'Cordas',
            ],
            [
                'nome' => 'Gibson Guitarra Les Paul Standard',
                'descricao' => 'Guitarra elétrica com corpo robusto, timbre encorpado e acabamento clássico.',
                'preco' => 12999.00,
                'quantidade' => 5,
                'categoria' => 'Cordas',
            ],
            [
                'nome' => 'Yamaha Violão Eletroacústico APX600',
                'descricao' => 'Violão eletroacústico confortável, ideal para estudo, palco e gravação.',
                'preco' => 1999.00,
                'quantidade' => 12,
                'categoria' => 'Cordas',
            ],
            [
                'nome' => 'Tagima Violão Folk Aço',
                'descricao' => 'Violão folk com cordas de aço, sonoridade brilhante e boa projeção.',
                'preco' => 899.00,
                'quantidade' => 20,
                'categoria' => 'Cordas',
            ],
            [
                'nome' => 'Fender Contrabaixo Precision 4 Cordas',
                'descricao' => 'Contrabaixo elétrico de 4 cordas com timbre grave e presença marcante.',
                'preco' => 7499.00,
                'quantidade' => 7,
                'categoria' => 'Cordas',
            ],
            [
                'nome' => 'Giannini Ukulele Soprano',
                'descricao' => 'Ukulele soprano compacto, leve e indicado para iniciantes.',
                'preco' => 389.00,
                'quantidade' => 18,
                'categoria' => 'Cordas',
            ],
            [
                'nome' => 'Rozini Cavaquinho Acústico',
                'descricao' => 'Cavaquinho acústico indicado para samba, choro e estudos musicais.',
                'preco' => 649.00,
                'quantidade' => 10,
                'categoria' => 'Cordas',
            ],
            [
                'nome' => 'Eagle Violino 4/4 Estudante',
                'descricao' => 'Violino tamanho 4/4 para estudantes, acompanha arco e estojo.',
                'preco' => 799.00,
                'quantidade' => 9,
                'categoria' => 'Cordas',
            ],
            [
                'nome' => 'Squier Guitarra Telecaster Classic',
                'descricao' => 'Guitarra elétrica com timbre definido, corpo sólido e estilo clássico.',
                'preco' => 5999.00,
                'quantidade' => 6,
                'categoria' => 'Cordas',
            ],
            [
                'nome' => 'Tagima Baixo Jazz Bass 4 Cordas',
                'descricao' => 'Baixo elétrico de 4 cordas com captação dupla e timbre versátil.',
                'preco' => 4299.00,
                'quantidade' => 8,
                'categoria' => 'Cordas',
            ],

            /* =========================
               AMPLIFICADORES
            ========================= */

            [
                'nome' => 'Fender Amplificador Frontman 20G',
                'descricao' => 'Amplificador compacto para guitarra, ideal para estudo e prática diária.',
                'preco' => 1499.00,
                'quantidade' => 10,
                'categoria' => 'Amplificadores',
            ],
            [
                'nome' => 'Boss Amplificador Katana 50 MKII',
                'descricao' => 'Amplificador para guitarra com efeitos integrados e potência para ensaios.',
                'preco' => 2999.00,
                'quantidade' => 6,
                'categoria' => 'Amplificadores',
            ],
            [
                'nome' => 'Roland Amplificador Cube 10GX',
                'descricao' => 'Amplificador pequeno e versátil, indicado para estudo em casa.',
                'preco' => 1199.00,
                'quantidade' => 9,
                'categoria' => 'Amplificadores',
            ],
            [
                'nome' => 'Staner Amplificador Kute 25',
                'descricao' => 'Amplificador nacional para guitarra, simples e funcional para estudos.',
                'preco' => 799.00,
                'quantidade' => 11,
                'categoria' => 'Amplificadores',
            ],
            [
                'nome' => 'Meteoro Amplificador Nitrous Drive',
                'descricao' => 'Amplificador para guitarra com canal limpo e drive para prática musical.',
                'preco' => 1099.00,
                'quantidade' => 8,
                'categoria' => 'Amplificadores',
            ],
            [
                'nome' => 'Orange Amplificador Crush 20',
                'descricao' => 'Amplificador para guitarra com timbre encorpado e visual clássico.',
                'preco' => 1799.00,
                'quantidade' => 5,
                'categoria' => 'Amplificadores',
            ],
            [
                'nome' => 'Marshall Amplificador MG15',
                'descricao' => 'Amplificador compacto para guitarra com som clássico para estudo.',
                'preco' => 1599.00,
                'quantidade' => 7,
                'categoria' => 'Amplificadores',
            ],
            [
                'nome' => 'Borne Amplificador para Baixo BX50',
                'descricao' => 'Amplificador para contrabaixo com boa resposta de graves.',
                'preco' => 1899.00,
                'quantidade' => 6,
                'categoria' => 'Amplificadores',
            ],
            [
                'nome' => 'Fishman Amplificador Acústico A20',
                'descricao' => 'Amplificador para violão e instrumentos acústicos com som limpo.',
                'preco' => 1399.00,
                'quantidade' => 8,
                'categoria' => 'Amplificadores',
            ],
            [
                'nome' => 'Frahn Caixa Amplificada Multiuso 100W',
                'descricao' => 'Caixa amplificada multiuso para voz, instrumentos e pequenos eventos.',
                'preco' => 1299.00,
                'quantidade' => 10,
                'categoria' => 'Amplificadores',
            ],

            /* =========================
               PEDAIS / PEDALEIRAS
            ========================= */

            [
                'nome' => 'Boss Pedal DS-1 Distortion',
                'descricao' => 'Pedal de distorção clássico para guitarra, com som marcante e versátil.',
                'preco' => 599.00,
                'quantidade' => 15,
                'categoria' => 'Pedais/Pedaleiras',
            ],
            [
                'nome' => 'Ibanez Pedal Tube Screamer Mini',
                'descricao' => 'Pedal overdrive compacto com timbre quente e presença nos médios.',
                'preco' => 899.00,
                'quantidade' => 12,
                'categoria' => 'Pedais/Pedaleiras',
            ],
            [
                'nome' => 'Zoom Pedaleira G1X Four',
                'descricao' => 'Pedaleira multi-efeitos para guitarra com expressão e simulações integradas.',
                'preco' => 999.00,
                'quantidade' => 8,
                'categoria' => 'Pedais/Pedaleiras',
            ],
            [
                'nome' => 'Dunlop Pedal Cry Baby Wah',
                'descricao' => 'Pedal wah-wah tradicional para guitarra, usado em diversos estilos musicais.',
                'preco' => 1199.00,
                'quantidade' => 7,
                'categoria' => 'Pedais/Pedaleiras',
            ],
            [
                'nome' => 'Mooer Pedal Digital Delay',
                'descricao' => 'Pedal de delay digital com repetições limpas e controles simples.',
                'preco' => 549.00,
                'quantidade' => 13,
                'categoria' => 'Pedais/Pedaleiras',
            ],
            [
                'nome' => 'Boss Pedal Chorus Ensemble',
                'descricao' => 'Pedal chorus para guitarra, ideal para criar ambiência e profundidade.',
                'preco' => 699.00,
                'quantidade' => 9,
                'categoria' => 'Pedais/Pedaleiras',
            ],
            [
                'nome' => 'Boss Pedal Compressor Sustainer',
                'descricao' => 'Pedal compressor para controlar dinâmica e aumentar sustain.',
                'preco' => 649.00,
                'quantidade' => 10,
                'categoria' => 'Pedais/Pedaleiras',
            ],
            [
                'nome' => 'TC Electronic Pedal Reverb Digital',
                'descricao' => 'Pedal de reverb com ambiências para guitarra e instrumentos elétricos.',
                'preco' => 799.00,
                'quantidade' => 11,
                'categoria' => 'Pedais/Pedaleiras',
            ],
            [
                'nome' => 'Mooer Pedaleira Multi-efeitos GE100',
                'descricao' => 'Pedaleira compacta com simulações de amplificadores e efeitos variados.',
                'preco' => 849.00,
                'quantidade' => 7,
                'categoria' => 'Pedais/Pedaleiras',
            ],
            [
                'nome' => 'Korg Pedal Afinador Cromático',
                'descricao' => 'Pedal afinador com display de fácil leitura para palco e ensaio.',
                'preco' => 399.00,
                'quantidade' => 18,
                'categoria' => 'Pedais/Pedaleiras',
            ],

            /* =========================
               TECLAS
            ========================= */

            [
                'nome' => 'Casio Teclado CT-S300',
                'descricao' => 'Teclado portátil com 61 teclas, indicado para estudo e prática musical.',
                'preco' => 1250.00,
                'quantidade' => 14,
                'categoria' => 'Teclas',
            ],
            [
                'nome' => 'Casio Teclado Arranjador CT-X700',
                'descricao' => 'Teclado arranjador com timbres variados e recursos para aprendizado.',
                'preco' => 1390.00,
                'quantidade' => 10,
                'categoria' => 'Teclas',
            ],
            [
                'nome' => 'Casio Piano Digital CDP-S105',
                'descricao' => 'Piano digital compacto com teclas sensitivas e som realista.',
                'preco' => 2480.00,
                'quantidade' => 6,
                'categoria' => 'Teclas',
            ],
            [
                'nome' => 'Yamaha Teclado PSR-E373',
                'descricao' => 'Teclado com timbres diversos, indicado para estudo e apresentações simples.',
                'preco' => 1899.00,
                'quantidade' => 8,
                'categoria' => 'Teclas',
            ],
            [
                'nome' => 'Yamaha Piano Digital P-45',
                'descricao' => 'Piano digital com 88 teclas, ideal para estudantes e pianistas iniciantes.',
                'preco' => 3499.00,
                'quantidade' => 5,
                'categoria' => 'Teclas',
            ],
            [
                'nome' => 'M-Audio Controlador MIDI 49 Teclas',
                'descricao' => 'Controlador MIDI para produção musical, gravação e uso com softwares.',
                'preco' => 1099.00,
                'quantidade' => 9,
                'categoria' => 'Teclas',
            ],
            [
                'nome' => 'Yamaha Mini Teclado Portátil 32 Teclas',
                'descricao' => 'Mini teclado compacto para iniciantes, crianças e estudos básicos.',
                'preco' => 399.00,
                'quantidade' => 16,
                'categoria' => 'Teclas',
            ],
            [
                'nome' => 'Korg Sintetizador Monofônico',
                'descricao' => 'Sintetizador compacto para criação de timbres eletrônicos e experimentais.',
                'preco' => 2199.00,
                'quantidade' => 4,
                'categoria' => 'Teclas',
            ],
            [
                'nome' => 'Michael Acordeon 80 Baixos',
                'descricao' => 'Acordeon com 80 baixos, indicado para estudantes intermediários.',
                'preco' => 4999.00,
                'quantidade' => 3,
                'categoria' => 'Teclas',
            ],
            [
                'nome' => 'Tokai Órgão Eletrônico Compacto',
                'descricao' => 'Órgão eletrônico para estudo, prática religiosa e apresentações.',
                'preco' => 2799.00,
                'quantidade' => 4,
                'categoria' => 'Teclas',
            ],

            /* =========================
               PERCUSSÃO
            ========================= */

            [
                'nome' => 'Pearl Bateria Acústica Roadshow',
                'descricao' => 'Bateria acústica completa para estudo, ensaio e apresentações.',
                'preco' => 5799.00,
                'quantidade' => 4,
                'categoria' => 'Percussão',
            ],
            [
                'nome' => 'FSA Cajón Acústico',
                'descricao' => 'Cajón acústico com boa resposta sonora para estudos e apresentações.',
                'preco' => 499.00,
                'quantidade' => 15,
                'categoria' => 'Percussão',
            ],
            [
                'nome' => 'Contemporânea Pandeiro Profissional',
                'descricao' => 'Pandeiro profissional com pele sintética, indicado para samba e choro.',
                'preco' => 249.00,
                'quantidade' => 20,
                'categoria' => 'Percussão',
            ],
            [
                'nome' => 'Vic Firth Baquetas 5A',
                'descricao' => 'Par de baquetas 5A para bateria, com boa durabilidade e pegada confortável.',
                'preco' => 89.00,
                'quantidade' => 40,
                'categoria' => 'Percussão',
            ],
            [
                'nome' => 'Gope Surdo 20 Polegadas',
                'descricao' => 'Surdo de 20 polegadas para samba, escolas de bateria e percussão.',
                'preco' => 699.00,
                'quantidade' => 8,
                'categoria' => 'Percussão',
            ],
            [
                'nome' => 'Contemporânea Tamborim Profissional',
                'descricao' => 'Tamborim leve com afinação precisa para samba e pagode.',
                'preco' => 149.00,
                'quantidade' => 25,
                'categoria' => 'Percussão',
            ],
            [
                'nome' => 'Liverpool Bongô Madeira',
                'descricao' => 'Bongô em madeira com sonoridade clara e acabamento natural.',
                'preco' => 399.00,
                'quantidade' => 12,
                'categoria' => 'Percussão',
            ],
            [
                'nome' => 'LP Congas Par',
                'descricao' => 'Par de congas para percussão latina, estudos e apresentações.',
                'preco' => 1899.00,
                'quantidade' => 5,
                'categoria' => 'Percussão',
            ],
            [
                'nome' => 'Izzo Triângulo Cromado',
                'descricao' => 'Triângulo cromado para forró, música popular e estudos rítmicos.',
                'preco' => 79.00,
                'quantidade' => 30,
                'categoria' => 'Percussão',
            ],
            [
                'nome' => 'Gope Agogô Duplo',
                'descricao' => 'Agogô duplo metálico com som brilhante para ritmos brasileiros.',
                'preco' => 119.00,
                'quantidade' => 22,
                'categoria' => 'Percussão',
            ],

            /* =========================
               SOPRO
            ========================= */

            [
                'nome' => 'Eagle Sax Alto',
                'descricao' => 'Sax alto indicado para estudantes e músicos intermediários.',
                'preco' => 3999.00,
                'quantidade' => 5,
                'categoria' => 'Sopro',
            ],
            [
                'nome' => 'Yamaha Flauta Doce Germânica',
                'descricao' => 'Flauta doce germânica para iniciação musical e prática escolar.',
                'preco' => 69.00,
                'quantidade' => 50,
                'categoria' => 'Sopro',
            ],
            [
                'nome' => 'Hohner Gaita Blues Harp',
                'descricao' => 'Gaita diatônica para blues, folk e estilos populares.',
                'preco' => 289.00,
                'quantidade' => 18,
                'categoria' => 'Sopro',
            ],
            [
                'nome' => 'Michael Clarinete Sib',
                'descricao' => 'Clarinete em Sib para estudantes, bandas e prática musical.',
                'preco' => 1899.00,
                'quantidade' => 6,
                'categoria' => 'Sopro',
            ],
            [
                'nome' => 'Eagle Trompete Laqueado',
                'descricao' => 'Trompete laqueado para estudantes e músicos de bandas.',
                'preco' => 2199.00,
                'quantidade' => 5,
                'categoria' => 'Sopro',
            ],
            [
                'nome' => 'Michael Trombone de Vara',
                'descricao' => 'Trombone de vara com sonoridade encorpada para bandas e orquestras.',
                'preco' => 3299.00,
                'quantidade' => 4,
                'categoria' => 'Sopro',
            ],
            [
                'nome' => 'Yamaha Flauta Transversal',
                'descricao' => 'Flauta transversal para estudantes, com estojo e acessórios básicos.',
                'preco' => 1399.00,
                'quantidade' => 7,
                'categoria' => 'Sopro',
            ],
            [
                'nome' => 'CSR Escaleta 37 Teclas',
                'descricao' => 'Escaleta com 37 teclas, indicada para estudo e prática musical.',
                'preco' => 349.00,
                'quantidade' => 14,
                'categoria' => 'Sopro',
            ],
            [
                'nome' => 'Hoyden Melódica 32 Teclas',
                'descricao' => 'Melódica portátil para estudos musicais, iniciação e prática coletiva.',
                'preco' => 249.00,
                'quantidade' => 16,
                'categoria' => 'Sopro',
            ],
            [
                'nome' => 'Eagle Sax Tenor',
                'descricao' => 'Sax tenor indicado para músicos intermediários e apresentações.',
                'preco' => 5999.00,
                'quantidade' => 3,
                'categoria' => 'Sopro',
            ],

            /* =========================
               ÁUDIO E TECNOLOGIA
            ========================= */

            [
                'nome' => 'Shure Microfone SM58',
                'descricao' => 'Microfone dinâmico para voz, indicado para palco, ensaio e gravação.',
                'preco' => 1199.00,
                'quantidade' => 12,
                'categoria' => 'Áudio e tecnologia',
            ],
            [
                'nome' => 'Focusrite Interface Scarlett Solo',
                'descricao' => 'Interface de áudio compacta para gravações em home studio.',
                'preco' => 1299.00,
                'quantidade' => 9,
                'categoria' => 'Áudio e tecnologia',
            ],
            [
                'nome' => 'Sony Fone MDR-7506',
                'descricao' => 'Fone de ouvido para monitoração, gravação e mixagem.',
                'preco' => 999.00,
                'quantidade' => 10,
                'categoria' => 'Áudio e tecnologia',
            ],
            [
                'nome' => 'Santo Angelo Cabo P10 3 Metros',
                'descricao' => 'Cabo P10 de 3 metros para instrumentos, com boa durabilidade.',
                'preco' => 79.00,
                'quantidade' => 35,
                'categoria' => 'Áudio e tecnologia',
            ],
            [
                'nome' => 'Behringer Mesa de Som 8 Canais',
                'descricao' => 'Mesa de som compacta para pequenos eventos, ensaios e gravações.',
                'preco' => 1199.00,
                'quantidade' => 6,
                'categoria' => 'Áudio e tecnologia',
            ],
            [
                'nome' => 'Edifier Monitor de Áudio 5 Polegadas',
                'descricao' => 'Monitor de referência para produção musical e home studio.',
                'preco' => 1699.00,
                'quantidade' => 5,
                'categoria' => 'Áudio e tecnologia',
            ],
            [
                'nome' => 'Audio-Technica Microfone Condensador',
                'descricao' => 'Microfone condensador para voz, podcast, instrumentos e gravações.',
                'preco' => 699.00,
                'quantidade' => 13,
                'categoria' => 'Áudio e tecnologia',
            ],
            [
                'nome' => 'Arcano Suporte Articulado para Microfone',
                'descricao' => 'Suporte articulado para microfone, ideal para gravações e transmissões.',
                'preco' => 149.00,
                'quantidade' => 25,
                'categoria' => 'Áudio e tecnologia',
            ],
            [
                'nome' => 'Novation Controlador de Áudio USB',
                'descricao' => 'Controlador USB para produção musical e controle de software de áudio.',
                'preco' => 849.00,
                'quantidade' => 8,
                'categoria' => 'Áudio e tecnologia',
            ],
            [
                'nome' => 'Zoom Gravador Digital Portátil',
                'descricao' => 'Gravador portátil para entrevistas, ensaios, aulas e captação externa.',
                'preco' => 999.00,
                'quantidade' => 7,
                'categoria' => 'Áudio e tecnologia',
            ],

            /* =========================
               ACESSÓRIOS
            ========================= */

            [
                'nome' => 'D’Addario Encordoamento para Guitarra 010',
                'descricao' => 'Jogo de cordas para guitarra calibre 010, indicado para troca e manutenção.',
                'preco' => 69.00,
                'quantidade' => 40,
                'categoria' => 'Acessórios',
            ],
            [
                'nome' => 'Giannini Capotraste para Violão',
                'descricao' => 'Capotraste para violão e guitarra, ideal para mudança rápida de tonalidade.',
                'preco' => 49.00,
                'quantidade' => 35,
                'categoria' => 'Acessórios',
            ],
            [
                'nome' => 'Ibox Suporte para Guitarra',
                'descricao' => 'Suporte de chão para guitarra, baixo ou violão, com estrutura dobrável.',
                'preco' => 89.00,
                'quantidade' => 25,
                'categoria' => 'Acessórios',
            ],
            [
                'nome' => 'Korg Afinador Digital Cromático',
                'descricao' => 'Afinador digital cromático para instrumentos de corda e sopro.',
                'preco' => 119.00,
                'quantidade' => 30,
                'categoria' => 'Acessórios',
            ],
            [
                'nome' => 'Santo Angelo Cabo P10 5 Metros',
                'descricao' => 'Cabo P10 de 5 metros para instrumentos, com boa resistência e qualidade sonora.',
                'preco' => 99.00,
                'quantidade' => 28,
                'categoria' => 'Acessórios',
            ],
            [
                'nome' => 'NIG Fonte para Pedais 9V',
                'descricao' => 'Fonte 9V para pedais de efeito, indicada para setups de guitarra e baixo.',
                'preco' => 129.00,
                'quantidade' => 18,
                'categoria' => 'Acessórios',
            ],
            [
                'nome' => 'Fender Correia para Guitarra',
                'descricao' => 'Correia ajustável para guitarra, baixo e violão, com acabamento confortável.',
                'preco' => 159.00,
                'quantidade' => 22,
                'categoria' => 'Acessórios',
            ],
            [
                'nome' => 'Planet Waves Palhetas Medium',
                'descricao' => 'Kit de palhetas medium para guitarra e violão.',
                'preco' => 39.00,
                'quantidade' => 50,
                'categoria' => 'Acessórios',
            ],
            [
                'nome' => 'Solid Sound Pedalboard Compacto',
                'descricao' => 'Pedalboard compacto para organização e transporte de pedais.',
                'preco' => 349.00,
                'quantidade' => 12,
                'categoria' => 'Acessórios',
            ],
            [
                'nome' => 'Hercules Suporte para Microfone',
                'descricao' => 'Suporte para microfone com regulagem de altura, indicado para palco e estúdio.',
                'preco' => 249.00,
                'quantidade' => 16,
                'categoria' => 'Acessórios',
            ],
        ];

        foreach ($produtos as $produto) {
            DB::table('produtos')->updateOrInsert(
                ['nome' => $produto['nome']],
                [
                    'descricao' => $produto['descricao'],
                    'preco' => $produto['preco'],
                    'desconto' => null,
                    'data_inicio' => null,
                    'data_fim' => null,
                    'quantidade' => $produto['quantidade'],
                    'status' => 'ativo',
                    'imagem_principal' => null,
                    'imagens_extras' => json_encode([]),
                    'categoria' => $produto['categoria'],
                    'cores' => json_encode([]),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}