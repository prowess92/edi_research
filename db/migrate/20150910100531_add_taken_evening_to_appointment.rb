class AddTakenEveningToAppointment < ActiveRecord::Migration
  def change
    add_column :appointments, :taken_evening, :decimal
  end
end
