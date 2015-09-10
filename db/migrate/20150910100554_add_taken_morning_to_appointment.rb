class AddTakenMorningToAppointment < ActiveRecord::Migration
  def change
    add_column :appointments, :taken_morning, :decimal
  end
end
