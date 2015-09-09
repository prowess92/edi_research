class CreateClients < ActiveRecord::Migration
  def change
    create_table :clients do |t|
      t.decimal :client_id
      t.string :firstname
      t.string :surname
      t.date :dob
      t.string :gender
      t.string :education
      t.string :occupation
      t.string :marital_status
      t.string :literacy_level
      t.string :phone

      t.timestamps
    end
  end
end
