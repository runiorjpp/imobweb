<?php require_once "Views/shared/header.php";
$tipoImovel = match ($imovel[0]->TIPOIMOVEL) {
    '1' => 'Casa',
    '2' => 'Apartamento',
    '3' => 'Chácara',
    '4' => 'Edícula',
    '5' => 'Barracão',
    default => 'Desconhecido', // Caso o valor não esteja na lista
};

?>

<section class="detalhes">
    <div class="container">
        <div class="box12 mg-t-2">
            <h3 class="fonte24 espaco-letra poppins-meduim fw-300">Detalhes do imóvel <span class="fnc-vermelho">#<?= $imovel[0]->CODIGO; ?></span></h3>
            <div class="box-6 bg-cinza-claro radius shadow-down pd-20">
                <img src="lib/img/upload/<?= !empty($imovel[0]->IMAGEMCAPA) ? $imovel[0]->IMAGEMCAPA : 'default.jpg'; ?>" alt="Imagem Capa">

                <div class="box-12 flex justify-start flex-wrap">
                    <?php
                    $contador = 0;
                    if (isset($imagens) && count($imagens) > 0):
                        foreach ($imagens as $imagem):
                            $contador++;
                    ?>
                            <div class="box-2 radius shadow-down pd-10 bg-cinza-claro mg-b-1">
                                <a href="#img<?= $contador; ?>">
                                    <img src="lib/img/upload/<?= $imagem->IMAGEM; ?>" alt="Imagem <?= $contador; ?>">
                                </a>
                            </div>

                            <div class="modal" id="img<?= $contador; ?>">
                                <div class="imagem">
                                    <?php if ($contador > 1): ?>
                                        <a href="#img<?= $contador - 1; ?>">&#10094;</a> <!-- Seta esquerda -->
                                    <?php endif; ?>

                                    <a href="#">
                                        <img src="lib/img/upload/<?= $imagem->IMAGEM; ?>" alt="Imagem Grande <?= $contador; ?>">
                                    </a>

                                    <?php if ($contador < count($imagens)): ?>
                                        <a href="#img<?= $contador + 1; ?>">&#10095;</a> <!-- Seta direita -->
                                    <?php endif; ?>
                                </div>
                                <a href="#" class="close">X</a>
                            </div>

                    <?php
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
            <div class="box-6 shadow-dow pd-20">
                <div class="box-8">
                    <h3 class="fnc-preto-azul-claro fonte 22 espaco-letra mg-b-1">
                        <?= $tipoImovel ?>
                    </h3>
                    <p class="fonte16 fnc-cinza-medio espaco-letra mg-b-1"><?= $imovel[0]->LOGRADOURO . ',' . $imovel[0]->CIDADE; ?></p>
                    <p class="fonte22 fnc-vermelho fw-900 espaco-letra mg-b-1"><?php if ($imovel[0]->FINALIDADE == 1): echo "Venda";
                                                                                else: echo "Locação";
                                                                                endif; ?></p>


                </div>

                <div class="box-4 txt-c pd-t-2">
                    <p class="fonte22 fnc-vermelho fw-900 espaco-letra mg-b-1">
                        <span class="fonte16 fnc-preto-azulado">Valor do imovel<br></span>
                        R$<?= $formater->converterMoeda($imovel[0]->VALOR); ?>
                    </p>

                </div>
                <div class="box-12 divider mg-t-1 mg-b-1 "></div>

                <div class="box-12 mg-b-1 flex justify-between mg-t-2">
                    <p class="fonte16 fnc-preto-azulado">Quartos -<?= $imovel[0]->QUARTOS; ?></p>
                    <p class="fonte16 fnc-preto-azulado">Banheiros - <?= $imovel[0]->BANHEIROS; ?></p>
                    <p class="fonte16 fnc-preto-azulado">Area Total - <?= $imovel[0]->AREATOTAL; ?><b>&#13217;</b></p>
                    <p class="fonte16 fnc-preto-azulado">Area Construida - <?= $imovel[0]->AREACONSTRUIDA; ?><b>&#13217;</b></p>
                </div>
                <div class="box-12 mg-t-4">
                    <h3 class="fnc-cinza-medio fonte16 espaco-letra mg-b-1">
                        Ficou interessado?<br>
                        Entre em contato!
                    </h3>
                    <?php $mensagem = "Olá, estou interessado no imovel com a referencia #{$imovel[0]->CODIGO}"; ?>


                    <a href="https://wa.me/551130042222?text=<?= urlencode($mensagem); ?>" class="btn-big bg-whats" target="_blank">
                        <i class="fa-brands fa-whatsapp fnc-branco fonte48"></i>
                    </a>

                </div>

            </div>
        </div>
    </div>
</section>