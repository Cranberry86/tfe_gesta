<h2>Modifier un Contrat à <?php echo $participant->t_nom . ' ' . $participant->t_prenom ?></h2>


<script>

    $(function() {
        $("#datedebut , #datefin,#datefinprevu,.jour").datepicker({
            dateFormat: 'dd/mm/yy',
            selectOtherMonths: true,
            changeMonth: true,
            changeYear: true,
            dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
            firstDay: 1,
            yearRange: 'c-2:c+4'
        })
    });

    $( document ).ready(function() {
        $("#datedebut").change(function(){

            var d = $("#datedebut").datepicker('getDate');

            var n = new Date(d.getFullYear() + 1, d.getMonth(), d.getDate());

            $("#datefin").datepicker('setDate',n);
            $("#datefinprevu").datepicker('setDate',n);
        });
    });

</script>

<script>
    $(document).ready(function() {
        $("table#additionnal_infos").hide();

        $("#b_derogation_rw").change(function() {

            if ($("#b_derogation_rw").val() == 1) {
                $("table#additionnal_infos").show("fast");
            }
            else {
                $("table#additionnal_infos").hide();
            }

        });


    });
</script>




<script type="text/javascript">
    $(document).ready(function() {
        $('div.toggler-c').toggleElements(
                {fxAnimation: 'slide', fxSpeed: 'slow', className: 'toggler'});

    });
</script>

<div class="toggler-c" title="Ajouter un nouveau contrat" id="contrat">

<?php echo Form::open(array('class' => 'form-horizontal')); ?>

<fieldset>

    <table class="form">
        <tr>
            <td>
                <table class="form-left">
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Groupe');
                            echo Form::select('groupe', Input::post('groupe', isset($contrat) ? $contrat->groupe_id : ''), $getgroupe);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Contrat');
                            echo Form::select('type_contrat', Input::post('type_contrat', isset($contrat) ? $contrat->type_contrat_id : ''), $getcontrat);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Date début contrat');
                            echo Form::input('d_date_debut_contrat', Input::post('d_date_debut_contrat', isset($contrat) ? $contrat->d_date_debut_contrat : ''), array('id'=>'datedebut', 'required' => 'required'))
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Date fin contrat prévue');
                            echo Form::input('d_date_fin_contrat_prevu', Input::post('d_date_fin_contrat_prevu', isset($contrat) ? $contrat->d_date_fin_contrat_prevu : ''), array('id'=>'datefinprevu', 'required' => 'required'))
                            ?>
                        </td>
                    </tr>     <tr>
                        <td>
                            <?php
                            echo Form::label('Date fin contrat');
                            echo Form::input('d_date_fin_contrat', Input::post('d_date_fin_contrat', isset($contrat) ? $contrat->d_date_fin_contrat : ''), array('id'=>'datefin'))
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Remarque');
                            echo Form::input('t_remarque', Input::post('t_remarque', isset($contrat) ? $contrat->t_remarque : ''))
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Frais de déplacement');
                            echo Form::input('f_frais_deplacement', Input::post('f_frais_deplacement', isset($contrat) ? $contrat->f_frais_deplacement : '0'));
                            echo '€';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Durée Innocupation');
                            echo Form::input('t_duree_innoccupation', Input::post('t_duree_innoccupation', isset($contrat) ? $contrat->t_duree_innoccupation : ''))
                            ?><br />
                            En mois (nombres entier).
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Avertissement 1');
                            echo Form::input('d_avertissement1', Input::post('d_avertissement1', isset($contrat) ? $contrat->d_avertissement1 : ''), array('class' => 'jour'))
                            ?>
                        </td>
                    </tr>
                    <tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Motif Avertissement 1');
                            echo Form::input('t_motif_avertissement1', Input::post('t_motif_avertissement1', isset($contrat) ? $contrat->t_motif_avertissement1 : ''))
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
            <td>
                <table class="form-right">
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Dérogation Région Wallonne');
                            echo Form::select('b_derogation_rw', Input::post('b_derogation_rw', isset($contrat) ? $contrat->b_derogation_rw : ''), array('2' => 'Non', '1' => 'Oui'), array('id' => 'b_derogation_rw'));
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Abonnement');
                            echo Form::input('t_abonnement', Input::post('t_abonnement', isset($contrat) ? $contrat->t_abonnement : '0'));
                            echo '€';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Tarif Horaire');
                            echo Form::input('f_tarif_horaire', Input::post('f_tarif_horaire', isset($contrat) ? $contrat->f_tarif_horaire : '1'));
                            echo '€';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Situation Sociale à l\'entrée');
                            echo Form::select('t_situation_sociale', Input::post('t_situation_sociale', isset($contrat) ? $contrat->t_situation_sociale : ''), $statut);
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <?php
                            echo Form::label('Avertissement 2');
                            echo Form::input('d_avertissement2', Input::post('d_avertissement2', isset($contrat) ? $contrat->d_avertissement2 : ''), array('class' => 'jour'))
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Motif Avertissement 2');
                            echo Form::input('t_motif_avertissement2', Input::post('t_motif_avertissement2', isset($contrat) ? $contrat->t_motif_avertissement2 : ''))
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Avertissement 3');
                            echo Form::input('d_avertissement3', Input::post('d_avertissement3', isset($contrat) ? $contrat->d_avertissement3 : ''), array('class' => 'jour'))
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php
                            echo Form::label('Motif Avertissement 3');
                            echo Form::input('t_motif_avertissement3', Input::post('t_motif_avertissement3', isset($contrat) ? $contrat->t_motif_avertissement3 : ''))
                            ?>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</fieldset>

<!--
<p>
<?php
echo Form::label('Temps de travail', 'i_temps_travail');
echo Form::input('i_temps_travail', Input::post('i_temps_travail', isset($contrat) ? $contrat->i_temps_travail : ''), array('required' => 'required'));
echo '%';
?>
</p> -->

<table class="form" id="additionnal_infos">
    <tr>
        <td>
            <table class="form-left">
                <tr>
                    <td><script>
    $(document).ready(function() {
        $("table#additionnal_infos").hide();

        $("#b_derogation_rw").change(function() {

            if ($("#b_derogation_rw").val() == 1) {
                $("table#additionnal_infos").show("fast");
            }
            else {
                $("table#additionnal_infos").hide();
            }

        });


    });
</script>
                        <?php
                        echo Form::label('La dérogation est nécessaire');
                        echo Form::select('b_necessaire', Input::post('b_necessaire', isset($contrat) ? $contrat->b_necessaire : ''), array('2' => 'Non', '1' => 'Oui'), array('id' => 'b_necessaire'));
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        echo Form::label('Date de la demande');
                        echo Form::input('d_date_demande_derogation_rw', Input::post('d_date_demande_derogation_rw', isset($contrat) ? $contrat->d_date_demande_derogation_rw : ''), array('class' => 'jour'))
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        echo Form::label('Réponse du Forem');
                        echo Form::select('b_reponse_forem', Input::post('b_reponse_forem', isset($contrat) ? $contrat->b_reponse_forem : ''), array('2' => 'Non', '1' => 'Oui'));
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        echo Form::label('Date demande Forem');
                        echo Form::input('d_date_demande_forem', Input::post('d_date_demande_forem', isset($contrat) ? $contrat->d_date_demande_forem : ''), array('class' => 'jour'))
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        echo Form::label('Réponse Région Wallonne');
                        echo Form::select('b_reponse_rw', Input::post('b_reponse_rw', isset($contrat) ? $contrat->b_reponse_rw : ''), array('2' => 'Non', '1' => 'Oui'));
                        ?>
                    </td>
                </tr>
            </table>
        </td>
        <td>
            <table class="form-right">
                <tr>
                    <td>
                        <?php
                        echo Form::label('Dispense de l\'Onem');
                        echo Form::select('b_dispense_onem', Input::post('b_dispense_onem', isset($contrat) ? $contrat->b_dispense_onem : ''), array('2' => 'Non', '1' => 'Oui'));
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        echo Form::label('Date demande de l\'Onem');
                        echo Form::input('d_date_demande_onem', Input::post('d_date_demande_onem', isset($contrat) ? $contrat->d_date_demande_onem : ''), array('class' => 'jour'))
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        echo Form::label('Passé professionnel');
                        echo Form::input('t_passe_professionnel', Input::post('t_passe_professionnel', isset($contrat) ? $contrat->t_passe_professionnel : ''))
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        echo Form::label('Ressource');
                        echo Form::input('t_ressource', Input::post('t_ressource', isset($contrat) ? $contrat->t_ressource : ''))
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php
                        echo Form::label('Connaissance EFT');
                        echo Form::input('t_connaissance_eft', Input::post('t_connaissance_eft', isset($contrat) ? $contrat->t_connaissance_eft : ''))
                        ?>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<?php if ($fin_formation != null): ?>
    <h2>Fin de Formation</h2>

<table >
        <tr>
            <th>Fin de Formation</th>
            <th>Motif</th>
            <th>Date</th>
            <th></th>
        </tr>
        <tr>
            <td><?php echo $fin_formation->t_fin_formation ?></td>
            <td><?php echo $fin_formation->t_nom ?></td>
            <td><?php echo \Maitrepylos\Date::db_to_date($fin_formation->d_date_fin_formation) ?></td>
            <td><?php echo Html::anchor('contrat/fin_formation_modifier/'.$contrat->id_contrat.'/'.$participant->id_participant, Asset::img('edit.png'), array('title' => 'Modification')) ?></td>
        </tr>

    </table>



<?php endif; ?>


<div class="form-actions">
    <button type="submit" class="btn btn-success">Signer</button>
</div>

<?php echo Form::close() ?>
</div>







<p><?php echo Html::anchor('contrat/ajouter/'.$participant->id_participant, '<i class="icon-step-backward"></i> Retour', array('class' => 'btn pull-right')); ?></p>
<div class="clear"></div>