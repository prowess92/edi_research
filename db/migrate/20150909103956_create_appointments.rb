class CreateAppointments < ActiveRecord::Migration
  def change
    create_table :appointments do |t|
      t.decimal :client_id
      t.date :due_date
      t.decimal :created_by

      t.timestamps
    end
  end
end
