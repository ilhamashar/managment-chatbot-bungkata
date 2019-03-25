<?php
/**
 * Created by PhpStorm.
 * User: silenceangel
 * Date: 9/2/2018
 * Time: 3:45 PM
 */

class Home_model extends CI_Model
{
    var $table_user = 'user'; //nama tabel dari database

    function __construct()
    {
        parent::__construct();
    }

    public function get_user($user_id)
    {
        $query = $this->db->get_where($this->table_user, array('user_id' => $user_id));
        if($query->num_rows()) return $query->row();
        return NULL;
    }

    public function get_total_user_count()
    {
        $total = $this->db->count_all_results($this->table_user);
        return $total;
    }

    public function get_available_user_count()
    {
        $this->db->where("available=1");
        $total = $this->db->count_all_results($this->table_user);
        return $total;
    }

    public function get_today_new_user()
    {
        $this->db->where("DATE(created_at) = CURDATE()", NULL, FALSE);
        $query = $this->db->count_all_results($this->table_user);
        return $query;
    }

    /**
     * Dapatkan user dengan updated_at 5 menit terakhir
     * @return int
     */
    public function get_online_users()
    {
        $this->db->where("updated_at > DATE_SUB(CURRENT_TIME(), INTERVAL 5 MINUTE)");
        $query = $this->db->count_all_results($this->table_user);
        return $query;
    }

    public function get_user_statistic()
    {
        $sql = "SELECT
  SUM(IF(user_id IS NOT NULL , 1, 0)) total,
  SUM(IF(user_type='user' AND available=1, 1, 0)) user_total,
  SUM(IF(user_type='group' AND available=1, 1, 0)) group_total,
  SUM(IF(user_type='room' AND available=1, 1, 0)) room_total,
  DAY(td.db_date) date_day,
  td.db_date
FROM
  time_dimension td
  LEFT JOIN user u on td.db_date = DATE(u.created_at)
where
  td.db_date > DATE_SUB('2018-07-30', INTERVAL 30 DAY) AND td.db_date <= '2018-07-30' GROUP BY td.db_date, date_day ORDER BY td.db_date";
  //CURRENT_DATE
        $query = $this->db->query($sql);
        $result = $query->result();
        return $result;
    }

    public function get_user_sevenday()
    {
        $sql="SELECT
  HOUR(created_at) jam,
  DAY(created_at) hari,
  SUM(IF(game_mode='ordinal', 1, 0)) ordinal,
  SUM(IF(game_mode='vs_group', 1, 0)) vs_group,
  SUM(IF(game_mode='alone', 1, 0)) alone,
  SUM(IF(game_mode='multiplayer', 1, 0)) multiplayer,
  SUM(IF(game_mode='bungkata', 1, 0)) bungkata,
  SUM(IF(game_mode='endless', 1, 0)) endless,
  COUNT(*) total,
  DAY(td.db_date) date_day,
  td.db_date
  FROM
  time_dimension td
  LEFT JOIN game on td.db_date = DATE(game.created_at)
  WHERE
  DATE(created_at) ='2018-07-30'
  GROUP BY
  DAY(created_at),
  hour(created_at)";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

    public function get_user_hari1()
    {
        $sql="SELECT
  HOUR(created_at) jam,
  DAY(created_at) hari,
  SUM(IF(game_mode='ordinal', 1, 0)) ordinal,
  SUM(IF(game_mode='vs_group', 1, 0)) vs_group,
  SUM(IF(game_mode='alone', 1, 0)) alone,
  SUM(IF(game_mode='multiplayer', 1, 0)) multiplayer,
  SUM(IF(game_mode='bungkata', 1, 0)) bungkata,
  SUM(IF(game_mode='endless', 1, 0)) endless,
  COUNT(*) total,
  DAY(td.db_date) date_day,
  td.db_date
  FROM
  time_dimension td
  LEFT JOIN game on td.db_date = DATE(game.created_at)
  WHERE
  DATE(created_at) =('2018-07-30' - INTERVAL 1 DAY)
  GROUP BY
  DAY(created_at),
  hour(created_at)";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

  public function get_user_hari2()
    {
        $sql="SELECT
  HOUR(created_at) jam,
  DAY(created_at) hari,
  SUM(IF(game_mode='ordinal', 1, 0)) ordinal,
  SUM(IF(game_mode='vs_group', 1, 0)) vs_group,
  SUM(IF(game_mode='alone', 1, 0)) alone,
  SUM(IF(game_mode='multiplayer', 1, 0)) multiplayer,
  SUM(IF(game_mode='bungkata', 1, 0)) bungkata,
  SUM(IF(game_mode='endless', 1, 0)) endless,
  COUNT(*) total,
  DAY(td.db_date) date_day,
  td.db_date
  FROM
  time_dimension td
  LEFT JOIN game on td.db_date = DATE(game.created_at)
  WHERE
  DATE(created_at) =('2018-07-30' - INTERVAL 2 DAY)
  GROUP BY
  DAY(created_at),
  hour(created_at)";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

  public function get_user_hari3()
    {
        $sql="SELECT
  HOUR(created_at) jam,
  DAY(created_at) hari,
  SUM(IF(game_mode='ordinal', 1, 0)) ordinal,
  SUM(IF(game_mode='vs_group', 1, 0)) vs_group,
  SUM(IF(game_mode='alone', 1, 0)) alone,
  SUM(IF(game_mode='multiplayer', 1, 0)) multiplayer,
  SUM(IF(game_mode='bungkata', 1, 0)) bungkata,
  SUM(IF(game_mode='endless', 1, 0)) endless,
  COUNT(*) total,
  DAY(td.db_date) date_day,
  td.db_date
  FROM
  time_dimension td
  LEFT JOIN game on td.db_date = DATE(game.created_at)
  WHERE
  DATE(created_at) =('2018-07-30' - INTERVAL 3 DAY)
  GROUP BY
  DAY(created_at),
  hour(created_at)";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

  public function get_user_hari4()
    {
        $sql="SELECT
  HOUR(created_at) jam,
  DAY(created_at) hari,
  SUM(IF(game_mode='ordinal', 1, 0)) ordinal,
  SUM(IF(game_mode='vs_group', 1, 0)) vs_group,
  SUM(IF(game_mode='alone', 1, 0)) alone,
  SUM(IF(game_mode='multiplayer', 1, 0)) multiplayer,
  SUM(IF(game_mode='bungkata', 1, 0)) bungkata,
  SUM(IF(game_mode='endless', 1, 0)) endless,
  COUNT(*) total,
  DAY(td.db_date) date_day,
  td.db_date
  FROM
  time_dimension td
  LEFT JOIN game on td.db_date = DATE(game.created_at)
  WHERE
  DATE(created_at) =('2018-07-30' - INTERVAL 4 DAY)
  GROUP BY
  DAY(created_at),
  hour(created_at)";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

  public function get_user_hari5()
    {
        $sql="SELECT
  HOUR(created_at) jam,
  DAY(created_at) hari,
  SUM(IF(game_mode='ordinal', 1, 0)) ordinal,
  SUM(IF(game_mode='vs_group', 1, 0)) vs_group,
  SUM(IF(game_mode='alone', 1, 0)) alone,
  SUM(IF(game_mode='multiplayer', 1, 0)) multiplayer,
  SUM(IF(game_mode='bungkata', 1, 0)) bungkata,
  SUM(IF(game_mode='endless', 1, 0)) endless,
  COUNT(*) total,
  DAY(td.db_date) date_day,
  td.db_date
  FROM
  time_dimension td
  LEFT JOIN game on td.db_date = DATE(game.created_at)
  WHERE
  DATE(created_at) =('2018-07-30' - INTERVAL 5 DAY)
  GROUP BY
  DAY(created_at),
  hour(created_at)";
      $query = $this->db->query($sql);
      $result = $query->result();
      return $result;
    }

  public function get_user_hari6()
    {
        $sql="SELECT
  HOUR(created_at) jam,
  DAY(created_at) hari,
  SUM(IF(game_mode='ordinal', 1, 0)) ordinal,
  SUM(IF(game_mode='vs_group', 1, 0)) vs_group,
  SUM(IF(game_mode='alone', 1, 0)) alone,
  SUM(IF(game_mode='multiplayer', 1, 0)) multiplayer,
  SUM(IF(game_mode='bungkata', 1, 0)) bungkata,
  SUM(IF(game_mode='endless', 1, 0)) endless,
  COUNT(*) total,
  DAY(td.db_date) date_day,
  td.db_date
  FROM
  time_dimension td
  LEFT JOIN game on td.db_date = DATE(game.created_at)
  WHERE
  DATE(created_at) =('2018-07-30' - INTERVAL 6 DAY)
  GROUP BY
  DAY(created_at),
  hour(created_at)";
      $query = $this->db->query($sql);
      $result = $query->result();
      // var_dump($result);
      // exit;
      return $result;
    }

    public function get_user_hari7()
    {
        $sql="SELECT
  HOUR(created_at) jam,
  DAY(created_at) hari,
  SUM(IF(game_mode='ordinal', 1, 0)) ordinal,
  SUM(IF(game_mode='vs_group', 1, 0)) vs_group,
  SUM(IF(game_mode='alone', 1, 0)) alone,
  SUM(IF(game_mode='multiplayer', 1, 0)) multiplayer,
  SUM(IF(game_mode='bungkata', 1, 0)) bungkata,
  SUM(IF(game_mode='endless', 1, 0)) endless,
  COUNT(*) total,
  DAY(td.db_date) date_day,
  td.db_date
  FROM
  time_dimension td
  LEFT JOIN game on td.db_date = DATE(game.created_at)
  WHERE
  DATE(created_at) =('2018-07-30' - INTERVAL 7 DAY)
  GROUP BY
  DAY(created_at),
  hour(created_at)";
      $query = $this->db->query($sql);
      $result = $query->result();
      // var_dump($result);
      // exit;
      return $result;
    }
}