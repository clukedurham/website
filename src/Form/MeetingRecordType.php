<?php

namespace App\Form;

use App\Entity\MeetingRecord;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

use App\Entity\ManagingEntity;

class MeetingRecordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $managingEntities = $options['managing_entities'];
        $builder
            ->add('approved_date', DateType::class, array(
                'years' => array(
                    '2018', '2019', '2020', '2021', '2022', '2023', '2024', '2025', '2026', '2027', '2028', '2029'
                ),
                'format' => 'yyyy-MMMM-d',
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day'
                )
            ))
            ->add('document', FileType::class, array('label' => 'Upload Document (.pdf)', 'data_class' => null))
            ->add('managing_entity', ChoiceType::class, [
                'choices' => $managingEntities,
                'choice_label' => function($managingEntity, $key, $value) {
                    /** @var TeamMember $teamMember */
                    $name = $managingEntity->getName();
                    return $name;
                }
            ])
            ->add('save', SubmitType::class)
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MeetingRecord::class,
            'managing_entities' => null
        ]);
    }
}
