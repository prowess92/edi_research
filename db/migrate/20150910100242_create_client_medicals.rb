class CreateClientMedicals < ActiveRecord::Migration
  def change
    create_table :client_medicals do |t|
      t.decimal :client_id
      t.string :regimen
      t.string :sulphur_allegy

      t.timestamps
    end
  end
end
