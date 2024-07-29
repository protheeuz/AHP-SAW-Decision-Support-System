<?php
namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Perhitungan extends ActiveRecord
{
    public static function tableName()
    {
        return 'penilaian';
    }

    public static function getKriteria()
    {
        return Kriteria::find()->all();
    }

    public static function getAlternatif()
    {
        return Alternatif::find()->all();
    }

    public static function getDeskripsi()
    {
        return SubKriteria::find()->all();
    }

    public static function dataNilai($id_alternatif, $id_kriteria)
    {
        return self::find()
            ->joinWith('subKriteria')
            ->where(['penilaian.id_alternatif' => $id_alternatif, 'penilaian.id_kriteria' => $id_kriteria])
            ->one();
    }

    public static function getMaxMin($id_kriteria)
    {
        $query = (new \yii\db\Query())
            ->select([
                'max(sub_kriteria.nilai) as max',
                'min(sub_kriteria.nilai) as min',
                'sub_kriteria.nilai as nilai',
                'kriteria.jenis'
            ])
            ->from('penilaian')
            ->join('JOIN', 'sub_kriteria', 'penilaian.nilai=sub_kriteria.id_sub_kriteria')
            ->join('JOIN', 'kriteria', 'penilaian.id_kriteria=kriteria.id_kriteria')
            ->where(['penilaian.id_kriteria' => $id_kriteria])
            ->one();
        return $query;
    }

    public static function getHasil()
    {
        return (new \yii\db\Query())
            ->select('*')
            ->from('hasil')
            ->orderBy(['nilai' => SORT_DESC])
            ->limit(15)
            ->all();
    }

    public static function getHasilBanyak()
    {
        return (new \yii\db\Query())
            ->select('*')
            ->from('hasil')
            ->orderBy(['nilai' => SORT_DESC])
            ->all();
    }

    public static function getHasilAlternatif($id_alternatif)
    {
        return Alternatif::find()
            ->where(['id_alternatif' => $id_alternatif])
            ->one();
    }

    public static function insertNilaiHasil($hasil_akhir = [])
    {
        $command = Yii::$app->db->createCommand();
        return $command->insert('hasil', $hasil_akhir)->execute();
    }

    public static function hapusHasil()
    {
        return Yii::$app->db->createCommand()->truncateTable('hasil')->execute();
    }

    public function rules()
    {
        return [
            [['id_alternatif', 'id_kriteria', 'nilai', 'nama'], 'required'],
        ];
    }
}