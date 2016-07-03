<?php

class Raw extends Model
{
    /**
     * we save all imported data to a table
     * @param array $data
     * @return array
     */
    public function store($data)
    {
        return $this->db->rawQuery("INSERT INTO
                                    raw_table (title, description, price, init_date, expiry_date, adress, name)
                                    VALUES (?, ?, ?, ?, ?, ?, ?)", $data
        );
    }

    /**
     * we look for the name and count of products by store we group by adress
     * @return array
     */
    public function getProductByMerchant()
    {
        return $this->db->rawQuery("SELECT name, COUNT(*) AS count FROM raw_table GROUP BY adress");
    }

    /**
     * we look for the count of products by month, our count is based on expire date.
     * @return array
     */
    public function getProductByMonth()
    {
        return $this->db->rawQuery("    SELECT
                                        COUNT(*) as count,
                                          MONTHNAME(expiry_date) AS month
                                        FROM
                                        (SELECT DISTINCT title, description, price, init_date, expiry_date from raw_table) as p
                                        GROUP BY MONTH(expiry_date)
        ");
    }
}